<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" max-width="500">
            <v-card class="mx-auto" max-width="500">
                <h1 class="text-center pt-5">Finalizar Pedido</h1>
                <v-card-text>
                    <h2 class="pt-5">Método de Pagamento</h2>
                    <v-radio-group v-model="requestPayMethod" row>
                        <v-radio label="Dinheiro" value="1"></v-radio>
                        <v-radio label="Cartão" value="2"></v-radio>
                    </v-radio-group>
                    <div v-if="requestPayMethod == 1">
                        Troco para: <v-text-field v-model="requestChangeFor"></v-text-field>
                    </div>
                    <v-divider class="mb-4"></v-divider>
                    <h2>Endereço</h2>
                    <v-row>
                        <v-col cols="8">
                            <v-text-field label="CEP" v-model="requestAddress.requestCEP" append-outer-icon="mdi-magnify" v-on:click:append-outer="getAddress" single-line></v-text-field>
                        </v-col>
                        <v-col cols="4">
                            <v-select v-bind:items="UFsArray" v-model="requestAddress.requestUF" label="Estado"></v-select>
                        </v-col>
                    </v-row>
                    <v-text-field label="Cidade" v-model="requestAddress.requestCity" single-line></v-text-field>
                    <v-text-field label="Bairro" v-model="requestAddress.requestNeighbourhood" single-line></v-text-field>
                    <v-text-field label="Rua" v-model="requestAddress.requestStreet" single-line></v-text-field>
                    <v-row>
                        <v-col cols="4">
                            <v-text-field label="Nº" v-model="requestAddress.requestNumber" single-line></v-text-field>
                        </v-col>
                        <v-col cols="8">
                            <v-text-field label="Complemento" v-model="requestAddress.requestComplement" single-line></v-text-field>
                        </v-col>
                    </v-row>
                    <v-text-field label="Referência" v-model="requestAddress.requestReference" single-line></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <div class="mx-auto">
                        <v-btn text color="indigo" v-on:click.stop="sendRequestHandler(requestPayMethod, requestChangeFor, requestAddress); dialog = false;">
                            Finalizar Pedido
                        </v-btn>
                        <v-btn text color="red" v-on:click.stop="dialog = false">
                            Fechar
                        </v-btn>
                    </div>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-snackbar v-model="snackbar">
          {{ errorText }}
          <v-btn color="indigo" text v-on:click="snackbar = false">Fechar</v-btn>
        </v-snackbar>
    </v-row>
</template>

<script>
import axios from 'axios';

export default {
    name: "AdressPayMethodDialog",
    props: {
        sendRequestHandler: Function
    },
    data () {
        return {
            requestPayMethod: '1',
            requestChangeFor: 0.0,
            requestAddress: {
                requestCEP: '',
                requestUF: '',
                requestCity: '',
                requestNeighbourhood: '',
                requestStreet: '',
                requestNumber: '',
                requestComplement: '',
                requestReference: ''
            },
            UFsArray: ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'],
            snackbar: false,
            errorText: ''
        }
    },
    methods: {
        getAddress() {
            if (!this.requestAddress.requestCEP) {
                this.errorText = "Preencha o campo CEP";
                this.snackbar = true;
                return;
            }

            if (!new RegExp('(^[0-9]{5}-[0-9]{3}$)|(^[0-9]{8}$)', 'i').test(this.requestAddress.requestCEP)) {
                this.errorText = "CEP inválido.";
                this.snackbar = true;
                return;
            }
            
            axios.get('https://viacep.com.br/ws/' + this.requestAddress.requestCEP.replace('-', '') + '/json/')
                .then((response) => {
                    if (response.data.erro) {
                        this.errorText = "CEP inexistente/não cadastrado. Por favor, preencha manualmente.";
                        this.snackbar = true;
                        return;
                    }

                    this.requestAddress.requestUF = response.data.uf.toUpperCase();
                    this.requestAddress.requestCity = response.data.localidade;
                    this.requestAddress.requestNeighbourhood = response.data.bairro;
                    this.requestAddress.requestStreet = response.data.logradouro;
                }).catch((error) => {
                    console.log(error);
                })
        }
    },
    computed: {
        dialog: {
            get() {
                return this.$attrs.value;
            },
            set(value) {
                this.$emit('input', value);
            }
        }
    }
}
</script>