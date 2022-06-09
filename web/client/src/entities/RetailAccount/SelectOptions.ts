import defaultEntityBehavior from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import { SelectOptionsType } from "@irontec/ivoz-ui/entities/EntityInterface";
import RetailAccount from "./RetailAccount";

const RetailAccountSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  return defaultEntityBehavior.fetchFks(
    RetailAccount.path,
    ["id", "name"],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken
  );
};

export default RetailAccountSelectOptions;
