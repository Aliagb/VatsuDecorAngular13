import { Component, OnInit } from '@angular/core';
import { UIService } from '../ui.service';

@Component({
  selector: 'app-product-item',
  templateUrl: './product-item.component.html',
  styleUrls: ['./product-item.component.css']
})
export class ProductItemComponent implements OnInit {

  productsItems: any[] = [];

  constructor(private uiService: UIService) { }

  ngOnInit(): void {
    this.uiService.fetchProductsItems().subscribe(data => {
      this.productsItems = data;
    });
  }

}
