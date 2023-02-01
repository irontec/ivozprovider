import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type WebPortalPropertyList<T> = {
  url?: T;
  klearTheme?: T;
  name?: T;
  id?: T;
  logo?: T;
};

export type WebPortalProperties = WebPortalPropertyList<Partial<PropertySpec>>;
export type WebPortalPropertiesList = Array<
  WebPortalPropertyList<EntityValue | EntityValues>
>;
