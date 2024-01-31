
import { Component, OnInit } from '@angular/core';
import { CartService } from '../Services/cart/cart.service';
import { CartItem } from '../models/cart_item.model';
import { Product } from '../models/product.model'; 

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  cartItems: CartItem[] = [];
  displayedColumns: string[] = ['productImage', 'productName', 'quantity', 'price', 'actions'];


  constructor(private cartService: CartService) { }

  removeItem(item: any) {
    
    // this.cartItems = this.cartItems.filter(cartItem => cartItem.product.id !== item.product.id);
  }
  
  ngOnInit(): void {
    this.cartService.getCartItems().subscribe(
        (items: any[]) => {
            console.log('Received cart items:', items);

            // Map the JSON response to your TypeScript models
            this.cartItems = items.map((item) => ({
                customer_id: +item.customer_id,
                quantity: +item.quantity,
                product: {
                    product_id: +item.product_id,
                    name: item.name,
                    description: item.description,
                    qty: +item.qty,
                    price: +item.price,
                    img: item.img,
                    category: item.category
                },
                calculateTotalPrice: function() {
                  return this.quantity * this.product.price;
              }
  
            }));
        },
        (error) => {
            console.error('Error fetching cart items', error);
        }
    );
}
}