import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type CompanyServicePropertyList<T> = {
  service?: T;
  code?: T;
};

export type CompanyServiceProperties = CompanyServicePropertyList<
  Partial<PropertySpec>
>;
export type CompanyServicePropertiesList = Array<
  CompanyServicePropertyList<EntityValue | EntityValues>
>;
