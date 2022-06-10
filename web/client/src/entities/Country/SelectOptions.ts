import defaultEntityBehavior from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import { SelectOptionsType } from "@irontec/ivoz-ui/entities/EntityInterface";
import Country from "./Country";

const CountrySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  return defaultEntityBehavior.fetchFks(
    Country.path,
    ["id", "name", "countryCode"],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = `${Country.toStr(item)} (${item.countryCode})`;
      }

      callback(options);
    },
    cancelToken
  );
};

export default CountrySelectOptions;
