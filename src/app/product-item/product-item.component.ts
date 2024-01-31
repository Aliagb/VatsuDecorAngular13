import { Component, OnInit } from '@angular/core';
import { UIService } from '../ui.service';
import {BreakpointObserver, Breakpoints} from '@angular/cdk/layout';
import { CartService } from '../Services/cart/cart.service';
import { Product } from '../models/product.model';
import { CartItem } from '../models/cart_item.model';

@Component({
  selector: 'app-product-item',
  templateUrl: './product-item.component.html',
  styleUrls: ['./product-item.component.css']
})
export class ProductItemComponent implements OnInit {

  productsItems: Product[] = [];

  constructor(
    private uiService: UIService,
    private responsive: BreakpointObserver,
    private cartService: CartService )
     { }

     addToCart(selectedProductId: number) {
      this.cartService.addCartItem(selectedProductId).subscribe(
        response => {
            console.log('Product added to cart:', response);
        },
        error => {
            console.error('Error adding product to cart:', error);
        }
    );
}

  ngOnInit(): void {
    this.responsive.observe(Breakpoints.HandsetLandscape)
      .subscribe(result => {

        if (result.matches) {
          console.log("screens matches HandsetLandscape");
        }

  });

    this.uiService.fetchProductsItems().subscribe(data => {
      this.productsItems = data;
    });
  }
  getNumberOfColumns(): number { //reponsive view
    if (window.innerWidth < 600) {
      return 1; // single column for small screens
    } else if (window.innerWidth < 960) {
      return 2; // two columns for medium screens
    } else {
      return 3; // three columns for large screens
    }
  }
  
}
