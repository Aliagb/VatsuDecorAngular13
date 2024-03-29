import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Product } from './models/product.model';

@Injectable({
  providedIn: 'root'
})
export class CRUDProductService {
  private apiUrl = 'http://localhost/VatsuDecorAngular13/php-api/CRUD-api'; 

  constructor(private http: HttpClient) { }

  // Create
  createProduct(productData: Product): Observable<any> {
    const formData = new FormData();
    if (productData.name) formData.append('name', productData.name);
    if (productData.description) formData.append('description', productData.description);
    if (productData.qty) formData.append('qty', productData.qty.toString());
    if (productData.price) formData.append('price', productData.price.toString());
        return this.http.post(`${this.apiUrl}/create.php`, formData);
  }

  // Read
  getProducts(): Observable<any> {
    return this.http.get<Product[]>(`${this.apiUrl}/read.php`);
  }

  // Update
  updateProduct(productData: Product): Observable<any> {
    const formData = new FormData();
    if (productData.product_id) formData.append('id', productData.product_id.toString());
    if (productData.name) formData.append('name', productData.name);
    if (productData.description) formData.append('description', productData.description);
    if (productData.price) formData.append('price', productData.price.toString());
    if (productData.qty) formData.append('qty', productData.qty.toString());

    return this.http.post(`${this.apiUrl}/update.php`, formData);
  }

  // Delete
  deleteProduct(productId: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/delete.php?id=${productId}`);
  }

  getProductById(productId: number): Observable<Product> {
    return this.http.get<Product>(`${this.apiUrl}/view_one.php?product_id=${productId}`);
  }
}
