import useFkChoices from "@irontec/ivoz-ui/entities/data/useFkChoices";
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import _ from "@irontec/ivoz-ui/services/translations/translate";
import { foreignKeyGetter } from "./foreignKeyGetter";

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const edit = props.edit || false;
  const create = props.create || false;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const readOnlyProperties = {
    routeType: edit,
  };

  const groups: Array<FieldsetGroups> = [
    {
      legend: _("Routing configuration"),
      fields: [
        "routeType",
        create && "user",
        create && "numberCountry",
        create && "numberValue",
        edit && "target",
      ],
    },
    {
      legend: _("Entry information"),
      fields: ["timeoutTime"],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={readOnlyProperties}
    />
  );
};

export default Form;
