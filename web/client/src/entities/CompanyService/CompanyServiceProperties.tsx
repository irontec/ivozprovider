import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type CompanyServicePropertyList<T> = {
    'service'?: T,
    'code'?: T,
};

export type CompanyServiceProperties = CompanyServicePropertyList<Partial<PropertySpec>>;
export type CompanyServicePropertiesList = Array<CompanyServicePropertyList<EntityValue|EntityValues>>;