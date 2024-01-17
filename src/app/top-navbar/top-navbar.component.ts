import { Component, OnInit } from '@angular/core';
import { UIService } from '../ui.service';

@Component({
  selector: 'app-top-navbar',
  templateUrl: './top-navbar.component.html',
  styleUrls: ['./top-navbar.component.css']
})
export class TopNavbarComponent implements OnInit {

  navbarItems: any[] = [];

  constructor(private uiService: UIService) { }

  ngOnInit(): void {
    this.uiService.getNavbarItems().subscribe(data => {
      this.navbarItems = data;
    });
  }
}