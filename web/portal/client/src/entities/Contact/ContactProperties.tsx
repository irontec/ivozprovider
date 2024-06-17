import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ContactPropertyList<T> = {
  name?: T;
  lastname?: T;
  email?: T;
  workPhone?: T;
  workPhoneCountry?: T;
  workPhoneE164?: T;
  mobilePhone?: T;
  mobilePhoneCountry?: T;
  mobilePhoneE164?: T;
  otherPhone?: T;
  user?: T;
};

export type ContactProperties = ContactPropertyList<Partial<PropertySpec>>;
export type ContactPropertiesList = Array<
  ContactPropertyList<EntityValue | EntityValues>
>;
