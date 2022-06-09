import { OutgoingDdiRulesPatternPropertyList } from "./OutgoingDdiRulesPatternProperties";
import { ForeignKeyGetterType } from "@irontec/ivoz-ui/entities/EntityInterface";
import entities from "../index";
import { autoSelectOptions } from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: OutgoingDdiRulesPatternPropertyList<Array<string | number>> =
    {};

  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
  });

  await Promise.all(promises);

  return response;
};
