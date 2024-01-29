// product-add.component.ts
import { Component } from '@angular/core';
import { CRUDProductService } from '../../crudproduct.service';
import { Product } from 'src/app/models/product.model';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';


@Component({
  selector: 'app-product-add',
  templateUrl: './product-add.component.html',
  styleUrls: ['./product-add.component.css']
})
export class ProductAddComponent {
  product: Product;


  constructor(
    private crudProductService: CRUDProductService,
    private snackBar: MatSnackBar,
    private router: Router)
     {
        this.product = new Product('', '', 1, 0);
        }
        onSubmit(event: Event): void {
          event.preventDefault();
          this.crudProductService.createProduct(this.product).subscribe(
            response => {
              console.log('Product added successfully!', response);
              
              this.snackBar.open('Product added successfully!', 'Close', {
                duration: 2000, 
              });
        
              setTimeout(() => {
                this.router.navigate(['/product-list']);
              }, 2000); 
            },
            error => {
              console.error('Error adding product', error);
            }
          );
        }
        
}