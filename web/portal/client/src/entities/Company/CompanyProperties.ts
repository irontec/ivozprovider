import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CompanyPropertyList<T> = {
  type?: T;
  name?: T;
  domainUsers?: T;
  onDemandRecordCode?: T;
  balance?: T;
  id?: T;
  invoicing?: T;
  language?: T;
  defaultTimezone?: T;
  country?: T;
  transformationRuleSet?: T;
  outgoingDdi?: T;
  outgoingDdiRule?: T;
  domainName?: T;
};

export type CompanyProperties = CompanyPropertyList<Partial<PropertySpec>>;
export type CompanyPropertiesList = Array<
  CompanyPropertyList<EntityValue | EntityValues>
>;
