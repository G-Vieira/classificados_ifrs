ahoy.configure({
  urlPrefix: "",
  visitsUrl: "/classificados_ifrs/tracking/visitas",
  eventsUrl: "/classificados_ifrs/tracking/eventos",
  page: null,
  platform: "Web",
  useBeacon: true,
  startOnReady: true,
  trackVisits: true,
  cookies: true,
  cookieDomain: null,
  headers: {},
  visitParams: {},
  withCredentials: false
});

ahoy.trackAll();