<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" max-width="500">
            <v-card class="mx-auto" max-width="500">
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
                    <h3 class="mt-5">Total a Pagar: <span class="green--text">R$ {{ request.requestTotalCost }}</span></h3>
                    <h3>Status: {{ request.requestStatus }}</h3>
                </v-card-text>
                
                <v-card-actions>
                    <div class="mx-auto">
                        <v-btn text color="indigo" v-if="request.requestStatus == 'Pendente'">
                            Aprovar Pedido
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
        request: Object
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