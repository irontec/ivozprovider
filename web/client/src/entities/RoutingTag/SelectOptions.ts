import defaultEntityBehavior from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import { SelectOptionsType } from "@irontec/ivoz-ui/entities/EntityInterface";
import RoutingTag from "./RoutingTag";

const RoutingTagSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  return defaultEntityBehavior.fetchFks(
    RoutingTag.path,
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

export default RoutingTagSelectOptions;
