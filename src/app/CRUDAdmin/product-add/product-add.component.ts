// product-add.component.ts
import { Component } from '@angular/core';
import { CRUDProductService } from '../../crudproduct.service';
import { Product } from 'src/app/models/product.model';

@Component({
  selector: 'app-product-add',
  templateUrl: './product-add.component.html',
  styleUrls: ['./product-add.component.css']
})
export class ProductAddComponent {
  product = {
    name: '',
    description: '',
    qty : 1,
    price: 0
  };

  constructor(private crudProductService: CRUDProductService) {
    this.product = new Product('', '', 1, 0);
  }
  onSubmit(event: Event): void {
    event.preventDefault();
    this.crudProductService.createProduct(this.product).subscribe(
      response => {
        console.log('Product added successfully!', response);
      },
      error => {
        console.error('Error adding product', error);
      }
    );
  }
}