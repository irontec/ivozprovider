import { ExtensionPropertyList } from "./ExtensionProperties";
import { ForeignKeyGetterType } from "@irontec/ivoz-ui/entities/EntityInterface";
import { autoSelectOptions } from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import entities from "../index";

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: ExtensionPropertyList<Array<string | number>> = {};

  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
  });

  await Promise.all(promises);

  return response;
};
