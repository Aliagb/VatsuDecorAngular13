import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TopNavbarComponent } from './top-navbar/top-navbar.component';
import { ProductListComponent } from './CRUDAdmin/product-list/product-list.component';
import { ProductItemComponent } from './product-item/product-item.component';
const routes: Routes = [
  { path: '', redirectTo: '/product-item', pathMatch: 'full' },
  { path: 'product-item', component: ProductItemComponent },
  { path: 'CRUDAdmin/product-list', component: ProductListComponent },

];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
