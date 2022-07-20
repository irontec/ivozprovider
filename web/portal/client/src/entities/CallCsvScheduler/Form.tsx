import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const edit = props.edit || false;
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
      legend: _('Basic Information'),
      fields: ['name', 'email'],
    },
    {
      legend: _('Time Information'),
      fields: [
        'frequency',
        'unit',
        edit && 'nextExecution',
        edit && 'lastExecution',
      ],
    },
    {
      legend: _('Filters'),
      fields: [
        'callDirection',
        'ddi',
        'endpointType',
        'user',
        'retailAccount',
        'residentialDevice',
        'fax',
        'friend',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
