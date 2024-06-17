import {
  criteriaToArray,
  queryStringToCriteria,
} from '@irontec-voip/ivoz-ui/components/List/List.helpers';
import useQueryStringParams from '@irontec-voip/ivoz-ui/components/List/useQueryStringParams';
import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useStoreActions, useStoreState } from 'store';

const useCriteriaChangeListener = (): number => {
  const [lastUpdate, setLastUpdate] = useState(new Date().getTime());

  const navigate = useNavigate();
  const queryStringCriteria = useStoreState(
    (state) => state.route.queryStringCriteria
  );
  const setQueryStringCriteria = useStoreActions((actions) => {
    return actions.route.setQueryStringCriteria;
  });

  const targetQueryString = criteriaToArray(queryStringCriteria).join('&');

  const currentQueryParams = useQueryStringParams();
  const currentQuerystring = currentQueryParams.join('&');
  const [prevReqQuerystring, setPrevReqQuerystring] =
    useState<string>(currentQuerystring);

  useEffect(() => {
    // route.queryStringCriteria change listener
    if (targetQueryString === prevReqQuerystring) {
      return;
    }

    if (currentQuerystring === targetQueryString) {
      return;
    }

    setPrevReqQuerystring(targetQueryString);

    let referrer = location.pathname;
    if (targetQueryString) {
      referrer += `?${targetQueryString}`;
    }

    // Change path
    navigate(
      {
        pathname: location.pathname,
        search: targetQueryString,
      },
      {
        state: {
          referrer,
        },
      }
    );

    setLastUpdate(new Date().getTime());
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [targetQueryString]);

  useEffect(() => {
    // Path change listener
    if (currentQuerystring === prevReqQuerystring) {
      return;
    }

    setPrevReqQuerystring(currentQuerystring);
    setQueryStringCriteria(queryStringToCriteria());
  }, [currentQuerystring]);

  return lastUpdate;
};

export default useCriteriaChangeListener;
