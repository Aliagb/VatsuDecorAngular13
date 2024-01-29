// cart.component.ts
import { Component, OnInit } from '@angular/core';
import { CartService } from '../Services/cart/cart.service';
import { CartItem } from '../models/cart_item.model';


@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  cartItems: CartItem[] = [];

  constructor(private cartService: CartService) { }

  ngOnInit(): void {
      this.loadCartItems();
  }

  loadCartItems() {
      // fetch user cart items here
  }

}