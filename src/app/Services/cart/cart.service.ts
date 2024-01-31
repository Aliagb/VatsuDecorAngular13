import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { CartItem } from 'src/app/models/cart_item.model';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private apiUrl = 'http://localhost/VatsuDecorAngular13/php-api/cart'; 

  constructor(private http: HttpClient) { }

  addCartItem(selectedProductId: number) { 
    return this.http.post(`${this.apiUrl}/add_to_cart.php`, { selectedProductId });
  }

  getCartItems(): Observable<CartItem[]> {
    return this.http.get<CartItem[]>(`${this.apiUrl}/get_cart_items.php`); 
  }

}
