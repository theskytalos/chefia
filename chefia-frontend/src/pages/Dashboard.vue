<template>
    <v-app id="inspire">
      <!--<v-navigation-drawer app permanent>
        <v-list dense>
          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Home</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-email</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Pedidos</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>-->
  
      <v-app-bar app color="indigo" dark>
        <v-toolbar-title>Dashboard</v-toolbar-title>
      </v-app-bar>
  
      <v-content>
        <v-container>
          <v-row>
              <v-col class="text-center">
                  <h1 v-if="requests.filter((element) => (element.requestStatus == '1')).length > 0">Existem {{ requests.filter((element) => (element.requestStatus == '1')).length }} pedidos pendentes.</h1>
                  <v-simple-table>
                    <template v-slot:default>
                      <thead>
                        <tr>
                          <th class="text-center">Nº</th>
                          <th class="text-center">Data</th>
                          <th class="text-center">Hora</th>
                          <th class="text-center">Método de Pagamento</th>
                          <th class="text-center">Total a Pagar</th>
                          <th class="text-center">Status</th>
                        </tr>
                      </thead>
                      <tbody v-if="requests.length > 0">
                        <tr v-for="(request, index) in requests" :key="index" v-on:click.stop="dialogRequest = request; showRequestDialog = true" hover>
                          <td>{{ request.requestId }}</td>
                          <td>{{ request.requestDatetime.getDate() }}/{{ request.requestDatetime.getMonth() + 1 }}/{{ request.requestDatetime.getFullYear() }}</td>
                          <td>{{ request.requestDatetime.getHours() }}:{{ String(request.requestDatetime.getMinutes()).padStart(2, "0") }}</td>
                          <td>{{ request.requestPayMethod }}</td>
                          <td class="green--text">R$ {{ request.requestTotalCost }}</td>
                          <td><span class="red--text" v-if="request.requestStatus == '2' || request.requestStatus == '1'">{{ request.requestStatusText }}</span><span class="green--text" v-else>{{ request.requestStatusText }}</span></td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="6">Não há pedidos</td>
                        </tr>
                      </tbody>
                    </template>
                  </v-simple-table>
              </v-col>
          </v-row>
          <RequestDialog v-model="showRequestDialog" v-bind:request="dialogRequest" v-bind:set-request-status-handle="setRequestStatus" />
        </v-container>
      </v-content>
      <v-footer color="indigo" app inset>
        <span class="white--text">Chefia &copy; 2020</span>
      </v-footer>
      <v-snackbar v-model="snackbar">
          {{ snackText }}
          <v-btn color="indigo" text v-on:click="snackbar = false">Fechar</v-btn>
      </v-snackbar>
    </v-app>
</template>

<script>
import RequestDialog from '../components/RequestDialog';
import Api from '../services/Api';

export default {
    components: {
      RequestDialog
    },
    props: {
      source: String
    },
    data: function () {
        return {
            requests: [],
            dialogRequest: {},
            showRequestDialog: false,
            snackbar: false,
            snackText: "" 
        }
    },
    mounted: function () {
      this.getTodaysRequests();

      setInterval(() => { this.getTodaysRequests(); }, 5000);
    },
    methods: {
      getTodaysRequests() {
        Api().post('RequestView.php', { apiRequest: 'getTodaysRequests' })
          .then((response) => {
              if (response.data.success) {
                let receivedRequests = response.data.content;

                receivedRequests.forEach((element) => {
                  if (element.requestPayMethod == 1)
                    element.requestPayMethod = "Dinheiro";
                  else
                    element.requestPayMethod = "Cartão";

                  element.requestDatetime = new Date(element.requestDatetime);

                  switch(element.requestStatus) {
                    case "1":
                      element.requestStatusText = "Pendente";
                      break;
                    case "2":
                      element.requestStatusText = "Reprovado";
                      break;
                    case "3":
                      element.requestStatusText = "Aprovado";
                      break;
                    case "4":
                      element.requestStatusText = "Saiu para Entrega";
                      break;
                    case "5":
                      element.requestStatusText = "Entregue";
                      break;
                    default:
                      element.requestStatusText = "Indefinido";
                  }

                  element.requestItems.forEach((item) => {
                    delete item.interactionModel;
                  })
                });

                this.requests = receivedRequests;
              } else {
                if (!response.data.content)
                  return;

                this.snackText = response.data.content;
                this.snackbar = true;
              }
          }).catch((error) => {
              console.log(error);
          });
      },
      setRequestStatus(requestId, requestStatus) {
        Api().post('RequestView.php', { apiRequest: 'setRequestStatus', requestId, requestStatus })
          .then((response) => {
            if (response.data.success === true) {
              if (!response.data.content)
                return;
              
              this.snackText = response.data.content;
              this.snackbar = true;
            } else {
              if (!response.data.content)
                  return;

              this.snackText = response.data.content;
              this.snackbar = true;
            }
          }).catch((error) => {
            console.log(error);
          })
      }
    }
}
</script>

<style scoped>

</style>