import { PropertyList } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, properties } = props;
  const edit = props.edit || false;
  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  if (edit) {
    const newProperties = { ...properties };
    newProperties.routingMode = {
      ...newProperties.routingMode,
      readOnly: true,
    };

    entityService.replaceProperties(newProperties as PropertyList);
  }
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['company', 'routingTag'],
    },
    {
      legend: _('Call destination'),
      fields: ['type', 'routingPattern', 'routingPatternGroup'],
    },
    {
      legend: _('Outgoing route'),
      fields: ['routingMode', 'carrier', edit && 'stopper'],
    },
    {
      legend: _('Failover and load-balancing'),
      fields: ['priority', 'weight'],
    },
    edit && {
      legend: _('Numeric transformation'),
      fields: ['prefix', 'forceClid', 'clidCountry', 'clid'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
