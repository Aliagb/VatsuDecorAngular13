import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CRUDProductService {
  private apiUrl = 'http://localhost/VatsuDecorAngular13/php-api/CRUD-api'; 

  constructor(private http: HttpClient) { }

  // Create
  createProduct(productData: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/create.php`, productData);
  }

  // Read
  getProducts(): Observable<any> {
    return this.http.get(`${this.apiUrl}/read.php`);
  }

  // Update
  updateProduct(productId: number, productData: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/update.php?id=${productId}`, productData);
  }

  // Delete
  deleteProduct(productId: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/delete.php?id=${productId}`);
  }
}
