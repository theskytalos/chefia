<template>
  <v-app id="inspire">
    <v-app-bar app color="indigo" dark>
      <v-toolbar-title>Chefia</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon v-on:click="resetConversation()">
        <v-icon>mdi-reload</v-icon>
      </v-btn>
    </v-app-bar>

    <v-content>
        <v-container>
            <v-row v-for="(speech, index) in speeches" v-bind:key="index" no-gutters>
                <v-col v-if="speech.type === 'chatbot'" class="col-11 col-lg-8">
                  <ChefiaBubble type="text" v-bind:text="speech.stateText" v-bind:options="speech.stateAlternatives" v-bind:get-next-chat-handler="getNextChat" v-bind:get-items-handler="getItems" v-bind:user-speech-handler="userSpeech" />
                </v-col>
                <v-col v-else-if="speech.type === 'user'" class="col-12">
                  <v-row>
                    <v-spacer class="col-7"></v-spacer>
                    <v-col class="col-5">
                      <UserBubble v-bind:text="speech.stateText" />
                    </v-col>
                  </v-row>
                </v-col>
                <v-col v-else-if="speech.type === 'menu'" class="col-11 col-lg-8">
                  <ChefiaBubble type="menu" v-bind:items="speech.items" v-bind:get-item-handler="getItem" />
                </v-col>
            </v-row>
        </v-container>
        <v-snackbar v-model="snackbar">
          {{ errorText }}
          <v-btn color="indigo" text v-on:click="snackbar = false">Fechar</v-btn>
        </v-snackbar>
    </v-content>
  </v-app>
</template>

<script>
import ChefiaBubble from '../components/ChefiaBubble';
import UserBubble from '../components/UserBubble';
import Api from '../services/Api';

export default {
    components:{
        ChefiaBubble,
        UserBubble
    },
    props: {
        source: String,
    },
    data: function () {
        return {
          speeches: [],
          states: [],
          snackbar: false,
          errorText: ""
        }
    },
    mounted: function () {
      this.getNextChat(0);
    },
    methods: {
      getWelcomeMessage() {

      },
      getNextChat(stateId) {
        Api().post('ChatView.php', { apiRequest: 'getNextChat', stateId: stateId })
          .then((response) => {
            console.log(response);
            if (response.data.success) {
              let stateObject = response.data.content.chatState;
              let alternativesArray = [];

              response.data.content.chatAlternatives.forEach((element) => {
                alternativesArray.push({ alternativeText: element.alternativeText, nextStateId: element.alternativeNextStateModel.stateId, menuCategoriesId: element.menuCategoryModel.menuCategoryId, menuItemId: element.menuItemModel.menuItemId });
              });
              
              stateObject.stateAlternatives = alternativesArray;
              stateObject.type = 'chatbot';

              this.states.push(stateObject);
              this.speeches.push(stateObject);
            } else {
              if (!response.data.content)
                return;
                
              this.errorText = response.data.content;
              this.snackbar = true;
            }
          })
          .catch((error) => {
            console.log(error);
          });
      },
      getItems(categoryId) {
        if (!categoryId)
          return;

        Api().post('MenuItemView.php', { apiRequest: 'getAllByCategory', menuCategoryId: categoryId })
          .then((response) => {
            if (response.data.success) {
              let itemsArray = response.data.content;

              let stateObject = {
                type: 'menu',
                items: itemsArray
              }

              this.speeches.push(stateObject);
            }
          })
          .catch((error) => {
            console.log(error);
          });
      },
      getItem(itemId) {
        if (!itemId)
          return;

        Api().post('MenuItemView.php', { apiRequest: 'get', menuItemId: itemId })
          .then((response) => {
            console.log(response);
            if (response.data.success) {
              alert(response.data.content);
            }
          })
          .catch((error) => {
            console.log(error);
          });
      },
      userSpeech(optionText) {
        let stateObject = {
          type: 'user',
          stateText: optionText
        }

        this.speeches.push(stateObject);
      },
      resetConversation() {
        this.states = [];
        this.speeches = [];
        this.getNextChat(0);
      }
    }
}
</script>