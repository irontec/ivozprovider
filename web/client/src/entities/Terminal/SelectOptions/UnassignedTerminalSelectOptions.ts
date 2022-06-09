import { SelectOptionsType } from "@irontec/ivoz-ui/entities/EntityInterface";
import store from "store";
import Terminal from "../Terminal";

type CustomPropsType = {
  _includeId: number;
};

const UnassignedTerminalSelectOptions: SelectOptionsType<CustomPropsType> = (
  { callback, cancelToken },
  customProps
): Promise<unknown> => {
  const params: any = {
    _properties: ["id", "name"],
  };
  const _includeId = customProps?._includeId;
  if (_includeId) {
    params._includeId = _includeId;
  }

  const getAction = store.getActions().api.get;
  return getAction({
    path: Terminal.path + "/unassigned",
    params,
    successCallback: async (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.name;
      }
      callback(options);
    },
    cancelToken,
  });
};

export default UnassignedTerminalSelectOptions;
