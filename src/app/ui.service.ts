import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UIService {

  constructor(private http: HttpClient) { }

  getNavbarItems() {
    return this.http.get<any>('http://localhost/VatsuDecorAngular13/php-api/UI/fetch-navbar-items.php');
  }
  fetchProductsItems() {
    return this.http.get<any>('http://localhost/VatsuDecorAngular13/php-api/getProducts.php');
  }
}
