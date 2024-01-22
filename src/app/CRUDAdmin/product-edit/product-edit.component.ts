import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { CRUDProductService } from 'src/app/crudproduct.service';
import { Product } from 'src/app/models/product.model';
import { MatSnackBar } from '@angular/material/snack-bar';

@Component({
  selector: 'app-product-edit',
  templateUrl: './product-edit.component.html',
  styleUrls: ['./product-edit.component.css']
})
export class ProductEditComponent implements OnInit {
  product!: Product;
  successMessage: string | null = null; 

  constructor(
    private crudProductService: CRUDProductService,
    private route: ActivatedRoute,
    private router: Router,
    private snackBar: MatSnackBar

  ) {}

  ngOnInit(): void {
    this.getProduct();
  }

  getProduct(): void {
    const idParam = this.route.snapshot.paramMap.get('id');
    const id = idParam !== null ? +idParam : null;
  
    if (id === null || isNaN(id)) {
      console.error('Invalid ID');
      return;
    }
    console.log('Product ID:', id);

    this.crudProductService.getProductById(id).subscribe(
      product => {
        console.log('Fetched product:', product); 
        this.product = product;
      },
      error => {
        console.error('Error fetching product', error);
      }
    );
  }
  

  onSubmit(): void {
    this.crudProductService.updateProduct(this.product).subscribe(
      response => {
        console.log('Product updated successfully!', response);
  
        this.snackBar.open('Product updated successfully!', 'Close', {
          duration: 2000, 
        });
  
        
        setTimeout(() => {
          this.router.navigate(['/product-list']);
        }, 2000); 
      },
      error => {
        console.error('Error updating product', error);
      }
    );
  }
  


}
  
