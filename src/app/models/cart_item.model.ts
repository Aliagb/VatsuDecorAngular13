import { Product } from "./product.model";

export class CartItem {
    customer_id: number;
    quantity: number;
    product: Product;

    constructor(customer_id: number, quantity: number, product: Product) {
        this.customer_id = customer_id;
        this.quantity = quantity;
        this.product = product;
    }

    calculateTotalPrice(): number {
        return this.quantity * this.product.price;
    }
}