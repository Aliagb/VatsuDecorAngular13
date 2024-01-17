import { TestBed } from '@angular/core/testing';

import { CRUDProductService } from './crudproduct.service';

describe('CRUDProductService', () => {
  let service: CRUDProductService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CRUDProductService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
