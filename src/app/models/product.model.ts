export class Product {
    id?: number;
    name: string;
    description: string;
    qty: number;
    price: number;

    constructor(name: string, description: string, qty: number, price: number) {
        this.name = name;
        this.description = description;
        this.qty = qty;
        this.price = price;
    }
}
