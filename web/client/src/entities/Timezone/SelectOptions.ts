import defaultEntityBehavior from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import { SelectOptionsType } from "@irontec/ivoz-ui/entities/EntityInterface";
import timezone from "./Timezone";

const TimezoneSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  return defaultEntityBehavior.fetchFks(
    timezone.path,
    ["id", "tz"],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.tz;
      }

      callback(options);
    },
    cancelToken
  );
};

export default TimezoneSelectOptions;
