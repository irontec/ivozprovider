import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: [
        'name',
        'lastname',
        'email',
        'pass',
        'doNotDisturb',
        'isBoss',
        'active',
        'maxCalls',
        'externalIpCalls',
        'rejectCallMethod',
        'multiContact',
        'gsQRCode',
        'id',
        'company',
        'bossAssistant',
        'transformationRuleSet',
        'language',
        'terminal',
        'timezone',
        'outgoingDdi',
        'oldPass',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
