import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { CartItem } from 'src/app/models/cart_item.model';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private apiUrl = 'http://localhost/VatsuDecorAngular13/php-api/cart'; 

  constructor(private http: HttpClient) { }

  addCartItem(cartItem: CartItem) { 
    return this.http.post(`${this.apiUrl}/add_to_cart.php`, cartItem);
  }
}
