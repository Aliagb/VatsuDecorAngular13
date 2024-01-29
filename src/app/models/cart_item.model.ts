import { Product } from "./product.model";


export interface CartItem {
    customer_id: number; 
    quantity: number;  
    product: Product;  
}
