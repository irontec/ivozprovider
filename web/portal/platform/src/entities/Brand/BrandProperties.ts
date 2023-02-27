import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type BrandPropertyList<T> = {
  id?: T;
  name?: T;
  invoice?: T;
  'invoice.nif'?: T;
  'invoice.postalAddress'?: T;
  'invoice.postalCode'?: T;
  'invoice.town'?: T;
  'invoice.province'?: T;
  'invoice.registryData'?: T;
  'invoice.country'?: T;
  logo?: T;
  domainUsers?: T;
  features?: T;
  proxyTrunks?: T;
  language?: T;
  defaultTimezone?: T;
  maxCalls?: T;
  currency?: T;
};

export type BrandProperties = BrandPropertyList<Partial<PropertySpec>>;
export type BrandPropertiesList = Array<
  BrandPropertyList<EntityValue | EntityValues>
>;
