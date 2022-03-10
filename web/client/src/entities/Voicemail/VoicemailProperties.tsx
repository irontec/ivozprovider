import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type VoicemailPropertyList<T> = {
    'enabled'?: T,
    'user'?: T,
    'residential'?: T,
    'name'?: T,
    'email'?: T,
    'sendMail'?: T,
    'attachSound'?: T,
    'locution'?: T,
};

export type VoicemailProperties = VoicemailPropertyList<Partial<PropertySpec>>;
export type VoicemailPropertiesList = Array<VoicemailPropertyList<EntityValue | EntityValues>>;