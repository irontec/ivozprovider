import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        'description',
        'password',
        'directConnectivity',
        'transport',
        'ip',
        'port',
        'multiContact',
      ],
    },
    {
      legend: _('Geographic Configuration'),
      fields: ['language', 'transformationRuleSet'],
    },
    {
      legend: _('Outgoing Configuration'),
      fields: ['outgoingDdi'],
    },
    {
      legend: _('Advanced Configuration'),
      fields: [
        'allow',
        'fromDomain',
        'ddiIn',
        't38Passthrough',
        'maxCalls',
        'rtpEncryption',
      ],
    },
    {
      legend: '',
      fields: ['status'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
