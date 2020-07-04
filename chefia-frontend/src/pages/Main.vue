<template>
  <v-app id="inspire">
    <v-app-bar app color="indigo" dark>
      <v-toolbar-title>Chefia</v-toolbar-title>
      <v-spacer></v-spacer>
      <router-link to="/dashboard" tag="button">
        <v-btn icon>
          <v-icon>mdi-cog</v-icon>
        </v-btn>
      </router-link>
      <v-btn icon v-if="cart.length > 0" v-on:click.stop="showCartDialog = true;">
        <v-icon>mdi-cart-outline</v-icon>
      </v-btn>
      <v-btn icon v-on:click="$vuetify.goTo(0)">
        <v-icon>mdi-arrow-up</v-icon>
      </v-btn>
      <v-btn icon v-on:click="resetConversation()">
        <v-icon>mdi-reload</v-icon>
      </v-btn>
    </v-app-bar>

    <v-content>
        <v-container>
            <v-row v-for="(speech, index) in speeches" v-bind:key="index" no-gutters>
                <v-col v-if="speech.type === 'chatbot'" class="col-11 col-lg-8">
                  <ChefiaBubble type="text" v-bind:text="speech.interactionContent" v-bind:transitions="speech.transitions" v-bind:options="speech.interactionAlternatives" v-bind:get-next-chat-handler="getNextChat" v-bind:user-speech-handler="userSpeech" v-bind:send-request-handler="sendRequest" v-bind:speeches-watch="speeches" />
                </v-col>
                <v-col v-else-if="speech.type === 'user'" class="col-12">
                  <v-row>
                    <v-spacer class="col-7"></v-spacer>
                    <v-col class="col-5">
                      <UserBubble v-bind:text="speech.interactionContent" />
                    </v-col>
                  </v-row>
                </v-col>
                <v-col v-else-if="speech.type === 'menu'" class="col-11 col-lg-8">
                  <ChefiaBubble type="menu" v-bind:text="speech.interactionContent" v-bind:transitions="speech.transitions" v-bind:items="speech.items" v-bind:options="speech.interactionAlternatives" v-bind:get-next-chat-handler="getNextChat" v-bind:user-speech-handler="userSpeech" v-bind:add-to-cart-handler="addToCart" v-bind:speeches-watch="speeches" v-bind:request-watch="isRequestDone" />
                </v-col>
                <v-col v-else-if="speech.type === 'image'" class="col-auto">
                  <ChefiaBubble type="image" v-bind:image-url="speech.imageUrl" />
                </v-col>
            </v-row>
            <CartDialog v-model="showCartDialog" v-bind:items="cart" v-bind:clear-cart-handler="clearCart" />
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
import CartDialog from '../components/CartDialog';
import Api from '../services/Api';

export default {
    components:{
        ChefiaBubble,
        UserBubble,
        CartDialog
    },
    props: {
        source: String,
    },
    data: function () {
        return {
          speeches: [],
          interactions: [],
          cart: [],
          request: {
            requestId: 0,
            requestStatus: 0
          },
          isRequestDone: false,
          showCartDialog: false,
          snackbar: false,
          errorText: "" 
        }
    },
    mounted: function () {
      this.getWelcomeMessage();
    },
    methods: {
      async getWelcomeMessage() {
        await this.getClientSettings();
        this.getNextChat(0);
      },
      getClientSettings() {
        Api().post('GeneralSettingView.php', { apiRequest: 'getAllClientSettings' })
          .then((response) => {
            console.log(response);
            if (response.data.success) {
              if (response.data.content) {
                let settingsArray = response.data.content;

                const imageUrl = settingsArray.find((element) => element.generalSettingKey === 'franchise_image');

                if (imageUrl !== undefined) {
                  let interactionObject = { type: 'image', imageUrl: imageUrl.generalSettingValue };
                  this.interactions.push(interactionObject);
                  this.speeches.push(interactionObject);
                }
              }
            } else {
              if (!response.data.content)
                return;
                
              this.errorText = response.data.content;
              this.snackbar = true;
            }
          }).catch((error) => {
            console.log(error);
          })
      },
      getNextChat(interactionId, itemAddedToCart = 0) {
        Api().post('ChatView.php', { apiRequest: 'get', interactionId, itemAddedToCart })
          .then((response) => {
            if (response.data.success) {
              let interactionObject = response.data.content.chatInteraction;
              let optionsArray = [];
              let transitionsArray = [];
              let itemsArray = [];
              let autoTransition = false;

              // Search for automatic transitions
              response.data.content.chatTransitions.forEach((element) => {
                if (element.transitionTypeModel.transitionTypeName === 'auto')
                  autoTransition = element.transitionToModel.interactionId;
              });

              // Get all the buttons type transitions
              response.data.content.chatTransitions.forEach((element) => {
                if (element.transitionTypeModel.transitionTypeName === 'button')
                  optionsArray.push({ transitionText: element.transitionValue, nextInteractionId: element.transitionToModel.interactionId });
              });

              // Get all the non-button and non-auto transitions
              response.data.content.chatTransitions.forEach((element) => {
                if (element.transitionTypeModel.transitionTypeName !== 'button' && element.transitionTypeModel.transitionTypeName !== 'auto')
                  transitionsArray.push({ transitionType: element.transitionTypeModel.transitionTypeName, transitionTo: element.transitionToModel.interactionId, transitionValue: element.transitionValue });
              });

              interactionObject.interactionAlternatives = optionsArray;
              interactionObject.transitions = transitionsArray;

              if (Array.isArray(response.data.content.chatItems))
                if (response.data.content.chatItems.length > 0)
                  itemsArray = Object.assign(itemsArray, response.data.content.chatItems);

              itemsArray.forEach((element) => {
                delete element.interactionModel;
              });
              
              if (itemsArray.length > 0) {
                interactionObject.type = 'menu';
                interactionObject.items = itemsArray;
              } else 
                interactionObject.type = 'chatbot';
              
              this.interactions.push(interactionObject);
              this.speeches.push(interactionObject);

              autoTransition = parseInt(autoTransition, 10);

              if (Number.isInteger(autoTransition))
                this.getNextChat(autoTransition);

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
      userSpeech(optionText) {
        let interactionObject = {
          type: 'user',
          interactionContent: optionText
        }

        this.speeches.push(interactionObject);
      },
      addToCart(item, quantity, observations) {
        let itemObject = { item, quantity, observations };
        this.cart.push(itemObject);
      },
      clearCart() {
        this.cart = [];
      },
      sendRequest(requestPayMethod, requestChangeFor, requestAddress, requestTo) {
        Api().post('RequestView.php', { apiRequest: 'create', requestPayMethod, requestChangeFor, requestCEP: requestAddress.requestCEP, requestUF: requestAddress.requestUF, requestCity: requestAddress.requestCity, requestNeighbourhood: requestAddress.requestNeighbourhood, requestStreet: requestAddress.requestStreet, requestNumber: requestAddress.requestNumber, requestComplement: requestAddress.requestComplement, requestReference: requestAddress.requestReference, requestItems: this.cart })
          .then((response) => {
            console.log(response);
            if (response.data.success === true) {
              this.isRequestDone = true;
              this.cart = [];
              
              if (response.data.requestId)
                this.request.requestId = parseInt(response.data.requestId, 10);

              this.getNextChat(requestTo);

              this.watchRequestStatusChanges();
            } else {
              this.errorText = response.data.content;
              this.snackbar = true;
            }
          }).catch((error) => {
            console.log(error);
          });
      },
      watchRequestStatusChanges() {
        var refreshRequestStatus = setInterval(() => {
          if (!this.isRequestDone)
            clearInterval(refreshRequestStatus);

          Api().post('RequestView.php', { apiRequest: 'getRequestStatus', requestId: this.request.requestId })
            .then((response) => {
              if (response.data.success === true) {
                if (this.request.requestStatus === 0) {
                  this.request.requestStatus = parseInt(response.data.content, 10);
                  return;
                }

                if (parseInt(response.data.content, 10) != this.request.requestStatus) {
                  this.request.requestStatus = parseInt(response.data.content, 10);
                  
                  let interactionObject;
                  let optionsArray = [];
                  let transitionsArray = [];

                  switch (response.data.content) {
                    case "2":
                      interactionObject = { type: "chatbot", interactionContent: "Seu pedido foi recusado!" };
                      break;
                    case "3":
                      interactionObject = { type: "chatbot", interactionContent: "Seu pedido foi aceito e está sendo preparado." };
                      break;
                    case "4":
                      interactionObject = { type: "chatbot", interactionContent: "Seu pedido saiu para entrega." };
                      break;
                    case "5":
                      interactionObject = { type: "chatbot", interactionContent: "Seu pedido foi entregue." };
                      clearInterval(refreshRequestStatus);
                      break;
                  }

                  interactionObject.interactionAlternatives = optionsArray;
                  interactionObject.transitions = transitionsArray;

                  this.speeches.push(interactionObject);
                }
              } else {
                this.errorText = response.data.content;
                this.snackbar = true;
              }
            }).catch((error) => {
              console.log(error);
            });
        }, 5000);
      },
      resetConversation() {
        this.interactions = [];
        this.speeches = [];
        this.cart = [];
        this.requestId = 0;
        this.isRequestDone = false;
        console.clear();
        this.getWelcomeMessage();
      }
    }
}
</script>