import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Product } from '../../models/product.model';
import { CRUDProductService } from '../../crudproduct.service';
import { UIService } from 'src/app/ui.service';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {
  products: Product[] = [];
  displayedColumns: string[] = ['id', 'image', 'name', 'description', 'price', 'actions'];

  constructor(
    private crudProductService: CRUDProductService,
    private uiService: UIService,
    private router: Router  // Router injected here
  ) {}

  ngOnInit(): void {
    this.fetchProducts();
  }

  fetchProducts(): void {
    this.crudProductService.getProducts().subscribe(
      data => {
        console.log('Fetched products:', data); 
        this.products = data;
      },
      error => {
        console.error('There was an error!', error);
      }
    );
  }

  navigateToAddProduct(): void {
    this.router.navigate(['/add-product']);
  }

  editProduct(product: Product): void {
    // Logic to edit product
  }

deleteProduct(productId: number): void {

  console.log('Deleting product with ID:', productId); 
  this.crudProductService.deleteProduct(productId).subscribe(
    response => {
      console.log('Product deleted successfully!', response);
      this.fetchProducts(); // fetchProducts after deletion
    },
    error => {
      console.error('Error deleting product', error);
    }
  );
}

  
}