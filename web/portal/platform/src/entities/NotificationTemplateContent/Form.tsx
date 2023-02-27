import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
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

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['language'],
    },
    {
      legend: _('From configuration'),
      fields: ['fromName', 'fromAddress'],
    },
    {
      legend: _('Contents configuration'),
      fields: ['bodyType', 'subject', 'body'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
