import { Component, OnInit } from '@angular/core';
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
  displayedColumns: string[] = ['id', 'name', 'description', 'price', 'actions'];

  constructor(private crudProductService: CRUDProductService,
    private uiService: UIService) {}

  ngOnInit(): void {
    this.fetchProducts();
  }

  fetchProducts(): void {
    this.uiService.fetchProductsItems().subscribe(
      data => {
        this.products = data;
      },
      error => {
        console.error('There was an error!', error);
      }
    );
  }

  editProduct(product: Product): void {
    // Logic to edit product
  }

  deleteProduct(productId: number): void {
    // Logic to delete product
  }
}
