import { ActionsSpec, PropertyList } from '@irontec-voip/ivoz-ui';
import ListContentHeader from '@irontec-voip/ivoz-ui/components/List/Content/ListContentHeader';
import useCancelToken from '@irontec-voip/ivoz-ui/hooks/useCancelToken';
import useCurrentPathMatch from '@irontec-voip/ivoz-ui/hooks/useCurrentPathMatch';
import EntityService from '@irontec-voip/ivoz-ui/services/entity/EntityService';
import { useTheme } from '@mui/material';
import useMediaQuery from '@mui/material/useMediaQuery';
import { memo, useMemo } from 'react';
import { useLocation } from 'react-router-dom';

import ActiveCalls from '../../entities/ActiveCalls/ActiveCalls';
import useCriteriaChangeListener from './hooks/useCriteriaChangeListener';

const FilterComponentMemo = memo(
  function FilterComponent(): JSX.Element {
    useCriteriaChangeListener();
    const [, cancelToken] = useCancelToken();
    const location = useLocation();
    const match = useCurrentPathMatch();

    const mobile = useMediaQuery(useTheme().breakpoints.down('md'));

    const entityService = useMemo(() => {
      return new EntityService(
        getActions(),
        ActiveCalls.properties as PropertyList,
        ActiveCalls
      );
    }, []);

    return (
      <ListContentHeader
        path={'/active_calls'}
        parentRow={undefined}
        ignoreColumn={undefined}
        entityService={entityService}
        preloadData={true}
        cancelToken={cancelToken}
        match={match}
        location={location}
        selectedValues={[]}
        mobile={mobile}
      />
    );
  },
  () => true
);

function getActions(): ActionsSpec {
  const actions: ActionsSpec = {
    get: {
      collection: {
        'Company-collection': {
          paths: ['/active_calls'],
          parameters: [
            {
              name: 'Brand',
              in: 'query',
              required: false,
              type: 'string',
            },
            {
              name: 'Company',
              in: 'query',
              required: false,
              type: 'string',
            },
            {
              name: 'Carrier',
              in: 'query',
              required: false,
              type: 'string',
            },
            {
              name: 'Direction',
              in: 'query',
              required: false,
              type: 'string',
            },
            {
              name: 'DdiProvider',
              in: 'query',
              required: false,
              type: 'string',
            },
          ],
          properties: {
            Brand: {
              type: 'integer',
            },
            Company: {
              type: 'integer',
            },
            Carrier: {
              type: 'integer',
            },
            Direction: {
              enum: ['Inbound', 'Outbound'],
              type: 'string',
            },
            DdiProvider: {
              type: 'integer',
            },
          },
          required: [],
          type: 'object',
        },
      },
    },
  };

  return actions;
}

export default FilterComponentMemo;
