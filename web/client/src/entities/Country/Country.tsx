import SettingsApplications from "@mui/icons-material/SettingsApplications";
import EntityInterface from "@irontec/ivoz-ui/entities/EntityInterface";
import _ from "@irontec/ivoz-ui/services/translations/translate";
import defaultEntityBehavior from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import { getI18n } from "react-i18next";
import { CountryProperties } from "./CountryProperties";
import selectOptions from "./SelectOptions";

const properties: CountryProperties = {
  name: {
    label: _("name"),
  },
};

const country: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplications,
  iden: "Country",
  title: _("Country", { count: 2 }),
  path: "/countries",
  toStr: (row: any) => {
    const language = getI18n().language.substring(0, 2);
    return row.name[language];
  },
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: "Countries",
  },
  selectOptions: (props, customProps) => {
    return selectOptions(props, customProps);
  },
};

export default country;
