import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type CompanyServicePropertyList<T> = {
    'service'?: T,
    'code'?: T,
};

export type CompanyServiceProperties = CompanyServicePropertyList<Partial<PropertySpec>>;
export type CompanyServicePropertiesList = Array<CompanyServicePropertyList<EntityValue | EntityValues>>;