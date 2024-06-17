import { PropertyList, ScalarProperty } from '@irontec-voip/ivoz-ui';
import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { DropdownObjectChoices } from '@irontec-voip/ivoz-ui/services/form/Field/Dropdown/Dropdown';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';
import { ClientFeatures } from 'store/clientSession/aboutMe';

const Form = (props: EntityFormProps): JSX.Element => {
  const edit = props.edit || false;
  const { entityService, row, match, properties } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const isVpbx = aboutMe?.vpbx;
  const isRetail = aboutMe?.retail;
  const isResidential = aboutMe?.residential;
  const isWholesale = aboutMe?.wholesale;

  const newProperties = { ...properties } as PropertyList;
  const endpointType = {
    ...properties.endpointType,
    enum: { ...(properties.endpointType as ScalarProperty).enum },
  } as ScalarProperty;
  const hasFaxesFeature = aboutMe?.features.includes(ClientFeatures.faxes);
  if (!hasFaxesFeature) {
    delete endpointType.enum?.fax;
  }
  const hasFriendsFeature = aboutMe?.features.includes(ClientFeatures.friends);
  if (!hasFriendsFeature) {
    delete endpointType.enum?.friend;
  }

  if (isRetail) {
    (endpointType.enum as DropdownObjectChoices).user = _('Retail Account', {
      count: 1,
    });
  } else if (isResidential) {
    (endpointType.enum as DropdownObjectChoices).user = _(
      'Residential Device',
      { count: 1 }
    );
  }

  newProperties.endpointType = endpointType;
  entityService.replaceProperties(newProperties);

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
        !isWholesale && 'ddi',
        !isWholesale && 'endpointType',
        isVpbx && 'user',
        isRetail && 'retailAccount',
        isResidential && 'residentialDevice',
        hasFaxesFeature && 'fax',
        hasFriendsFeature && 'friend',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
