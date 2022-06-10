import useFkChoices from "@irontec/ivoz-ui/entities/data/useFkChoices";
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import _ from "@irontec/ivoz-ui/services/translations/translate";
import { ConditionalRoutesConditionPropertyList } from "./ConditionalRoutesConditionProperties";
import { foreignKeyGetter } from "./foreignKeyGetter";

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices: ConditionalRoutesConditionPropertyList<any> = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups> = [
    {
      legend: _("Matching priority"),
      fields: ["priority"],
    },
    {
      legend: _("Matching type"),
      fields: ["matchListIds", "routeLockIds", "scheduleIds", "calendarIds"],
    },
    {
      legend: _("Matching handler"),
      fields: [
        "locution",
        "routeType",
        "numberCountry",
        "numberValue",
        "ivr",
        "user",
        "huntGroup",
        "voicemail",
        "friendValue",
        "queue",
        "conferenceRoom",
        "extension",
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
