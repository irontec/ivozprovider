import defaultEntityBehavior from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import { SelectOptionsType } from "@irontec/ivoz-ui/entities/EntityInterface";
import Service from "../Service";

type ServiceSelectOptionsArgs = {
  includeId?: number;
};

const UnassignedServiceSelectOptions: SelectOptionsType<
  ServiceSelectOptionsArgs
> = (props, customProps = {}): Promise<unknown> => {
  const { callback, cancelToken } = props;
  const { includeId } = customProps;

  let path = `${Service.path}/unassigned`;
  if (includeId) {
    path += `?_includeId=${includeId}`;
  }

  return defaultEntityBehavior.fetchFks(
    path,
    ["id", "name"],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = Service.toStr(item);
      }

      callback(options);
    },
    cancelToken
  );
};

export default UnassignedServiceSelectOptions;
