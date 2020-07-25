<template>
    <v-card class="mr-auto my-3 tri-right left-top" v-if="type === 'text'">
        <v-card-text>
            <div class="text--primary">
                {{ text }}
            </div>
        </v-card-text>
        <v-card-actions v-if="actionsAvailable && options.length !== 0 || Object.keys(sugestionTransition).length !== 0" class="horiz-scroll">
            <v-btn color="indigo" dark v-for="(option, index) in options" v-bind:key="index" v-on:click="userSpeechHandler(option.transitionText); getNextChatHandler(option.nextInteractionId);" class="horiz-scroll-item">{{ option.transitionText }}</v-btn>
            <v-btn color="indigo" dark v-if="Object.keys(sugestionTransition).length !== 0" v-on:click.stop="userSpeechHandler(sugestionTransition.transitionValue); showSugestionDialog = true;">{{ sugestionTransition.transitionValue }}</v-btn>
        </v-card-actions>
        <AddressPayMethodDialog v-model="showAddressPayMethodDialog" v-bind:send-request-handler="preSendRequest"/>
        <SugestionDialog v-model="showSugestionDialog" v-bind:dst="parseInt(sugestionTransition.transitionTo, 10)" v-bind:get-next-chat-handler="getNextChatHandler" />
    </v-card>
    <div v-else-if="type === 'menu'">
        <v-card class="mr-auto my-3 tri-right left-top">
            <v-card-text>
                <div class="text--primary">
                    {{ text }}
                </div>
            </v-card-text>
        </v-card>
        <v-card class="mr-auto my-3" v-if="!requestWatch">
            <v-card-text class="horiz-scroll">
                <v-card min-height="100%" min-width="250" max-width="250" class="horiz-scroll-item mr-3" v-for="item in items" v-bind:key="item.itemId">
                    <v-card-text>
                        <p class="display-1 text--primary">
                            {{ item.itemName }}
                        </p>
                        <p class="subtitle-2 green--text">
                            R$ {{ item.itemPrice }}
                        </p>
                        <v-divider></v-divider>
                        <div class="text--primary mt-3">
                            {{ item.itemDescription }}
                        </div>
                    </v-card-text>
                    <v-card-actions class="mt-auto">
                        <v-btn text color="indigo" class="mx-auto" v-on:click.stop="currentItem = item; showDishDialog = true">
                            Ver Item
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-card-text>
            <DishDialog v-model="showDishDialog" v-bind:item="currentItem" v-bind:add-to-cart-handler="addToCart" />
        </v-card>
        <v-card class="mr-auto my-3 tri-right left-top" v-if="actionsAvailable && options.length !== 0">
            <v-card-text>
                <v-card-actions class="horiz-scroll">
                    <v-btn color="indigo" dark v-for="(option, index) in options" v-bind:key="index" v-on:click="userSpeechHandler(option.transitionText); getNextChatHandler(option.nextInteractionId);" class="horiz-scroll-item">{{ option.transitionText }}</v-btn>
                </v-card-actions>
            </v-card-text>
        </v-card>
    </div>
    <div v-else-if="type === 'shops'">
        <v-card class="mr-auto my-3 tri-right left-top">
            <v-card-text>
                <div class="text--primary">
                    {{ text }}
                </div>
            </v-card-text>
        </v-card>
        <v-card class="mr-auto my-3">
            <v-card-text class="horiz-scroll">
                <v-card min-height="100%" min-width="250" max-width="250" class="horiz-scroll-item mr-3" v-for="shop in shops" v-bind:key="shop.shopId">
                    <v-card-text>
                        <p class="display-1 text--primary">
                            {{ shop.shopName }}
                        </p>
                        <p class="subtitle-2">
                            {{ shop.shopSpecialty }}
                        </p>
                        <v-divider></v-divider>
                        <div class="text--primary mt-3">
                            {{ shop.shopDescription }}
                        </div>
                    </v-card-text>
                    <v-card-actions class="mt-auto">
                        <v-btn text color="indigo" class="mx-auto" v-on:click.stop="currentShop = shop; showShopDialog = true">
                            Ver Estabelecimento
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-card-text>
            <ShopDialog v-model="showShopDialog" v-bind:shop="currentShop" />
        </v-card>
        <v-card class="mr-auto my-3 tri-right left-top" v-if="actionsAvailable && options.length !== 0">
            <v-card-text>
                <v-card-actions class="horiz-scroll">
                    <v-btn color="indigo" dark v-for="(option, index) in options" v-bind:key="index" v-on:click="userSpeechHandler(option.transitionText); getNextChatHandler(option.nextInteractionId);" class="horiz-scroll-item">{{ option.transitionText }}</v-btn>
                </v-card-actions>
            </v-card-text>
        </v-card>
    </div>
    <v-card class="mr-auto my-3 tri-right left-top" v-else-if="type === 'image'">
        <v-card-text>
            <div class="text--primary">
                <img v-bind:src="imageUrl" />
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import DishDialog from './DishDialog';
import ShopDialog from './ShopDialog';
import AddressPayMethodDialog from './AdressPayMethodDialog';
import SugestionDialog from './SugestionDialog';

export default {
    name: 'ChefiaBubble',
    data: function () {
        return {
            actionsAvailable: true,
            itemsAvailable: true,
            sugestionTransition: {},
            sugestionTransitionText: '',
            showDishDialog: false,
            showShopDialog: false,
            showAddressPayMethodDialog: false,
            showSugestionDialog: false,
            currentItem: {},
            currentShop: {}
        }
    },
    components: {
        DishDialog,
        ShopDialog,
        AddressPayMethodDialog,
        SugestionDialog
    },
    props: {
        type: String,
        text: String,
        imageUrl: String,
        options: Array,
        transitions: Array,
        items: Array,
        shops: Array,
        speechesWatch: Array,
        requestWatch: Boolean,
        getNextChatHandler: Function,
        userSpeechHandler: Function,
        addToCartHandler: Function,
        sendRequestHandler: Function
    },
    methods: {
        addToCart(item, quantity, observations) {
            this.addToCartHandler(item, quantity, observations);

            /* CHECK FOR 'add_to_cart' TRANSITIONS */
            const addToCartTransition = this.transitions.find(element => element.transitionType === 'add_to_cart');

            if (addToCartTransition !== undefined) {
                this.getNextChatHandler(addToCartTransition.transitionTo, item.itemId); 
                this.actionsAvailable = false;
            }
        },
        preSendRequest(requestPayMethod, requestChangeFor, requestAddress) {
            if (this.transitions) {
                const requestSentTransition = this.transitions.find(element => element.transitionType === 'request_sent');

                if (requestSentTransition !== undefined)
                    this.sendRequestHandler(requestPayMethod, requestChangeFor, requestAddress, requestSentTransition.transitionTo);
            }
        }
    },
    mounted: function () {
        this.$vuetify.goTo(this);

        if (this.transitions) {
            const requestSentTransition = this.transitions.find(element => element.transitionType === 'request_sent');
            const sendSugestionTransition = this.transitions.find(element => element.transitionType === 'send_sugestion');

            if (requestSentTransition !== undefined)
                this.showAddressPayMethodDialog = true;

            if (sendSugestionTransition !== undefined) {
                this.sugestionTransition = sendSugestionTransition;
            }
        }
    },
    watch: {
        speechesWatch: function () {
            this.actionsAvailable = false;
        }
    }
}
</script>

<style scoped>
    .horiz-scroll {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;     
    }

    .horiz-scroll-item {
        display: flex;
        flex-direction: column;
    }

    .v-card-dish {
        min-height: 100%;
        min-width: 300;
        max-width: 300;
    }
</style>