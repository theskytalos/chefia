<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" max-width="700">
            <v-card class="mx-auto" max-width="700">
                <h1 class="text-center pt-5">Pedido Nº {{ request.requestId }}</h1>
                <v-card-text>
                    <v-simple-table>
                        <template v-slot:default>
                            <thead>
                                <tr>
                                    <th class="text-left">Item</th>
                                    <th class="text-left">Quantidade</th>
                                    <th class="text-left">Observações</th>
                                    <th class="text-left">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in request.requestItems" v-bind:key="index">
                                    <td>{{ item.itemName }}</td>
                                    <td>{{ item.itemQuantity }}</td>
                                    <td>{{ item.itemNote }}</td>
                                    <td>R$ {{ (item.itemPrice * item.itemQuantity).toFixed(2) }}</td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                    <h3>UF: {{ request.requestUF }}</h3>
                    <h3>Cidade: {{ request.requestCity }}</h3>
                    <h3>Bairro: {{ request.requestNeighbourhood }}</h3>
                    <h3>Rua: {{ request.requestStreet }}</h3>
                    <h3>Nº: {{ request.requestNumber }}</h3>
                    <h3>Complemento: {{ request.requestComplement }}</h3>
                    <h3>Referência: {{ request.requestReference }}</h3>
                    <v-divider class="my-2"></v-divider>
                    <h3>Método de Pagamento: {{ request.requestPayMethod }}</h3>
                    <h3 v-if="request.requestPayMethod === 'Dinheiro'">Troco para: <span class="green--text">R$ {{ request.requestChangeFor }}</span></h3>
                    <h3>Total a Pagar: <span class="green--text">R$ {{ request.requestTotalCost }}</span></h3>
                    <h3>Status: {{ request.requestStatusText }}</h3>
                </v-card-text>
                
                <v-card-actions>
                    <div class="mx-auto">
                        <v-btn v-if="request.requestStatus == '1'" text color="indigo" v-on:click.stop="setRequestStatusHandle(request.requestId, 3); dialog = false">
                            Aprovar Pedido
                        </v-btn>
                        <v-btn v-if="request.requestStatus == '1'" text color="red" v-on:click.stop="setRequestStatusHandle(request.requestId, 2); dialog = false">
                            Recusar Pedido
                        </v-btn>
                        <v-btn text color="indigo" v-else-if="request.requestStatus == '3'" v-on:click.stop="setRequestStatusHandle(request.requestId, 4); dialog = false">
                            Saiu para Entrega
                        </v-btn>
                        <v-btn text color="indigo" v-else-if="request.requestStatus == '4'" v-on:click.stop="setRequestStatusHandle(request.requestId, 5); dialog = false">
                            Marcar como Entregue
                        </v-btn>
                        <v-btn text color="red" v-on:click.stop="dialog = false">
                            Fechar
                        </v-btn>
                    </div>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
export default {
    name: 'RequestDialog',
    props: {
        request: Object,
        setRequestStatusHandle: Function
    },
    data () {
        return {

        }
    },
    mounted () {

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