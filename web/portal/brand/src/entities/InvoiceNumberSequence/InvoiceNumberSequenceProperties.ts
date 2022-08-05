import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type InvoiceNumberSequencePropertyList<T> = {
  name?: T;
  prefix?: T;
  sequenceLength?: T;
  increment?: T;
  latestValue?: T;
  iteration?: T;
  version?: T;
  id?: T;
};

export type InvoiceNumberSequenceProperties = InvoiceNumberSequencePropertyList<Partial<PropertySpec>>;
export type InvoiceNumberSequencePropertiesList = Array<InvoiceNumberSequencePropertyList<EntityValue | EntityValues>>;
