<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" max-width="500">
            <v-card class="mx-auto" max-width="500">
                <h1 class="text-center pt-5">Carrinho</h1>
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
                                <tr v-for="(item, index) in items" v-bind:key="index">
                                    <td>{{ item.item.itemName }}</td>
                                    <td>{{ item.quantity }}</td>
                                    <td>{{ item.observations }}</td>
                                    <td>R$ {{ (item.item.itemPrice * item.quantity).toFixed(2) }}</td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                    <h3 class="mt-5">Total a Pagar: <span class="green--text">R$ {{ totalCost.toFixed(2) }}</span></h3>
                </v-card-text>
                
                <v-card-actions>
                    <div class="mx-auto">
                        <!--<v-btn text color="indigo">
                            Finalizar Pedido
                        </v-btn>-->
                        <v-btn text color="indigo" v-on:click.stop="clearCartHandler(); dialog = false">
                            Limpar Carrinho
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
    name: 'CartDialog',
    data () {
        return {
            totalCost: 0.0
        }
    },
    props: {
        items: Array,
        clearCartHandler: Function
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
    },
    watch: {
        items: function () {
            this.totalCost = 0.0;

            this.items.forEach((element) => {
                this.totalCost += element.item.itemPrice * element.quantity;
            });

            this.totalCost.toFixed(2);
        }
    }
}
</script>

<style scoped>

</style>