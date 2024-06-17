import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type InvoiceTemplatePropertyList<T> = {
  name?: T;
  description?: T;
  id?: T;
  template?: T;
  templateHeader?: T;
  templateFooter?: T;
  brand?: T;
};

export type InvoiceTemplateProperties = InvoiceTemplatePropertyList<
  Partial<PropertySpec>
>;
export type InvoiceTemplatePropertiesList = Array<
  InvoiceTemplatePropertyList<EntityValue | EntityValues>
>;
